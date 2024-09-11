import urllib.request
import datetime


timeFormat = '%d %B %Y %H:%M:%S %f'
print("Executing the low credit email script.\n" +  datetime.datetime.now().strftime(timeFormat))

try:
	link = "http://localhost/printsling/autoActions/merchantsMarkLowBalance"
	response = urllib.request.urlopen(link)
	data = response.read().decode("utf-8")
	print(data)
except urllib.error.URLError as e:
    print("Error loading URL. Reason: {}".format(e.reason))
except:
    print("Unexpected error:", sys.exc_info()[0])
    raise

print("Execution finished @ {}\n\n\n".format(datetime.datetime.now().strftime(timeFormat)))
exit();
