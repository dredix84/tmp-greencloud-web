<?php
/**
 * This script deals with system permissions
 */
return [
    'adminroles' => [0, 4],    //Deteremines what role IDs should be treated as an administrator
    'permissions' => [
        'Dashboard' => [
            'dashboards.changeapipassword' => 'Change API Password'
        ],
        'Application Features' => [
            'app.roleswtiching' => 'Role Swithcing',
			'merchants.switchto' => 'Switch Merchant Account'
        ],
        'Receipts' => [
            'receipts.viewcreditsused' => 'View credits used',
            'receipts.viewallmerchants' => 'View all merchants'
        ],
        'Roadmaps' => [
            'roadmaps.index' => 'Roadmap List',
            'roadmaps.view' => 'View Roadmap',
            'roadmaps.add' => 'Add Roadmap',
            'roadmaps.edit' => 'Edit Roadmap',
            'roadmaps.delete' => 'Delete Roadmap'
        ],
        'Merchant' => [
            'merchants.myaccounts' => 'My Merchant Accounts',
            'merchants.index' => 'Merchant List',
            'merchants.view' => 'View Merchant',
            'merchants.add' => 'Add Merchant',
            'merchants.edit' => 'Edit Merchant',
            'merchants.delete' => 'Deactiveate Merchant',
            'merchants.viewapicredentials' => 'View API credentials',
            'merchants.viewuser' => 'View Merchant User',
        ],
        'Reports' => [
            'reports.index' => 'Reports',
            'reports.monthlyactivity' => 'Monthly Activity',
            'reports.merchantsummary' => 'Merchant Summary',
            'reports.creditusagesummary' => 'Credit Usage Summary',
        ],
        'Application Menu' => [
            'menus.index' => 'Menu List',
            'menus.view' => 'View Menu',
            'menus.add' => 'Add Menu',
            'menus.edit' => 'Edit Menu',
            'menus.delete' => 'Delete Menu'
        ],
        'Roles' => [
            'roles.index' => 'Role List',
            'roles.view' => 'View Role',
            'roles.add' => 'Add Role',
            'roles.edit' => 'Edit Role',
            'roles.delete' => 'Delete Role',
            'roles.viewpermissions' => 'View permissions',
            'roles.editpermissions' => 'Edit permissions',
        ],
        'Users' => [
            'users.index' => 'User List',
            'users.view' => 'View User',
            'users.add' => 'Add User',
            'users.edit' => 'Edit User',
            'users.delete' => 'Delete User',
            'users.changepassword' => 'Change password',
            'users.reset-password' => 'Reset password'
        ],
        'Credits' => [
            'credits.index' => 'Credit List',
            'credits.view' => 'View Credit',
            'credits.add' => 'Add Credit',
            'credits.edit' => 'Edit Credit',
            'credits.delete' => 'Delete Credit',
        ],
        'SMS Log' => [
            'smslogs.index' => 'View SMS Log',
            'smslogs.view' => 'View SMS Details',
            'smslogs.viewall' => 'View all SMS log',
        ]
    ]
];
