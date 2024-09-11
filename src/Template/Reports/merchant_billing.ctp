<?php
/** @var array $merchants */

use Cake\Routing\Router;

?>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
<div id="app">
    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Receipts') ?></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <el-select v-model="search.merchant_id" clearable filterable placeholder="Select">
                                <el-option
                                    v-for="item in list.merchants"
                                    :key="item.id"
                                    :label="item.business_title"
                                    :value="item.id"
                                >
                                    <span>{{ item.business_title }} - ({{ item.id }})</span>
                                </el-option>
                            </el-select>
                        </div>

                        <div class="col-md-6">
                            <el-date-picker
                                v-model="search.date_range"
                                type="daterange"
                                align="right"
                                unlink-panels
                                value-format="yyyy-MM-dd"
                                range-separator="To"
                                start-placeholder="Start date"
                                end-placeholder="End date"
                                :picker-options="datePickerOptions">
                            </el-date-picker>
                        </div>

                        <div class="col-md-3">
                            <el-button type="success" @click="getData">Search</el-button>
                        </div>
                    </div>


                </div>
            </section>

            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Receipts') ?></h2>
                </header>
                <div class="panel-body">
                    <el-table
                        ref="multipleTable"
                        :data="tableData"
                        style="width: 100%"
                        @selection-change="handleSelectionChange"
                    >
                        <el-table-column
                            type="selection"
                            width="55">
                        </el-table-column>
                        <el-table-column type="expand">
                            <template slot-scope="props">
                                <div class="row" :id="'merchant-' + props.row.id">
                                    <div class="col-md-12">
                                        <p>Name: {{ props.row.business_title }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <el-table
                                            :data="props.row.receipts"
                                            style="width: 100%">
                                            <el-table-column
                                                prop="id"
                                                label="ID"
                                                width="180">
                                            </el-table-column>
                                            <el-table-column
                                                prop="receipt_number"
                                                label="Receipt #"
                                                width="180">
                                            </el-table-column>
                                            <el-table-column
                                                prop="receipt_date"
                                                label="Receipt Date">
                                            </el-table-column>
                                            <el-table-column
                                                prop="credits_used"
                                                label="Cost">
                                            </el-table-column>
                                        </el-table>

                                    </div>
                                    <div class="col-md-12">
                                        <el-table
                                            :data="props.row.sms_logs"
                                            style="
                                            width: 100%"
                                        >
                                            <el-table-column
                                                prop="id"
                                                label="ID"
                                                width="180">
                                            </el-table-column>
                                            <el-table-column
                                                prop="created"
                                                label="SMS Date">
                                            </el-table-column>
                                            <el-table-column
                                                prop="cost"
                                                label="Cost">
                                            </el-table-column>
                                        </el-table>

                                    </div>
                                </div>
                            </template>
                        </el-table-column>
                        <el-table-column
                            fixed
                            label="Name"
                            prop="name">
                        </el-table-column>
                        <el-table-column
                            label="City"
                            prop="city">
                        </el-table-column>
                        <el-table-column
                            label="Parish/State"
                            prop="parish_state">
                        </el-table-column>
                        <el-table-column
                            label="Receipts"
                            prop="receipts.length">
                        </el-table-column>
                        <el-table-column
                            label="SMS"
                            prop="sms_logs.length">
                        </el-table-column>
                        <el-table-column
                            fixed="right"
                            label="Operations"
                            width="120">
                            <template slot="header" slot-scope="scope">
                                <el-input
                                    v-model="tableSearch"
                                    size="mini"
                                    placeholder="Type to search"/>
                            </template>
                            <template slot-scope="props">
                                <el-button type="text" size="small" @click="getExcel(props.row.id)">Download XLSX</el-button>
                            </template>
                        </el-table-column>
                    </el-table>

                </div>
            </section>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            search: {
                merchant_id: null,
                date_range: null
            },
            list: {
                merchants: <?= json_encode($merchants) ?>
            },
            merchantData: [],
            selectedMerchants: [],
            tableSearch: '',
        },
        computed: {
            receiptsTableData: function () {
                if (this.merchantData && this.merchantData.receipts.length > 0) {

                }
            },
            tableData: function () {
                return this.merchantData.filter(
                    data => !this.tableSearch || data.name.toLowerCase().includes(this.tableSearch.toLowerCase())
                );
            },
            merchantOptions: function () {
                return this.merchants.map(
                    merchant => ({
                        value: merchant.id,
                        label: merchant.business_title
                    })
                );
            },
            datePickerOptions: function () {
                return {
                    shortcuts: [{
                        text: 'Last week',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: 'Last month',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: 'Last 3 months',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                            picker.$emit('pick', [start, end]);
                        }
                    }]
                };
            },
        },
        methods: {
            handleSelectionChange(val) {
                this.selectedMerchants = val;
            },
            getData: function () {
                var self = this;
                axios.get('<?=Router::url('/', true)?>/reports/get-merchant-billing.json', {params: this.search})
                    .then(({data}) => {
                        self.merchantData = data.merchants;
                        console.log(data);
                    })
                    .catch(err => {
                        console.error(err);
                        alert('There was an error while attempting to get the data.');
                    });
            },
            getExcel: function () {
                var self = this;

                var win = window.open(`<?=Router::url('/', true)?>/reports/get-merchant-billing?type=xlsx&merchant_id=${this.search.merchant_id}&date_range[]=${this.search.date_range[0]}&date_range[]=${this.search.date_range[1]}`, '_blank');
                win.focus();
            },
            getPdf: function (id) {
                var pdf = new jsPDF('p', 'in', 'letter');
                console.log('Print merchant-' + id);
                pdf.html(document.getElementById('merchant-' + id), {
                    callback: function (pdf) {
                        pdf.save('a4.pdf');
                    }
                });
            }
        }
    })
</script>
