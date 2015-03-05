# aws
This is the second challenge question: 
Write a shell script that describes ec2, rds, elb, elastic cache, and cloudformation information from us-east-1 region and outputs the data as a json document. Create a php or python script that calls the shell script, and parses the data to be viewed in html from the browser.

The first script aws.php will do:
1. create a form to retrieve the AWS access key and secret and uses those keys to set the environment for the user's profile for AWS CLI.
2. Launch the aws.sh script which will retrieve brief description of the products and output the results in json format to /tmp (note: default AWS CLI output is json).
2. Read those json files from /tmp and dump the data to the screen while looping through each product.

It Assumes the following:
AWS CLI tools are installed with all their dependencies.
