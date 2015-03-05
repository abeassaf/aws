#! /bin/sh
# File name: aws.sh
# Author: Abe Assaf
# This is a simple script the runs the AWS CLI tools to 
# describe AWS products. This script assume that you have installed 
# AWS CLI on your system.
tmpdir="/tmp"
aws ec2 describe-instances      >    "$tmpdir/ec2.json" 
aws rds describe-db-instances   >    "$tmpdir/rds.json"
aws elb describe-load-balancers >    "$tmpdir/elb.json"
aws elasticache describe-events >    "$tmpdir/elc.json"
aws cloudformation describe-stacks > "$tmpdir/clf.json"

