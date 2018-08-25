Yii 2 project with MongoDB database
============================  

database connection settings

	mongodb' => [  
		'class' => '\yii\mongodb\Connection',  
    #'dsn' => 'mongodb://username:password@hostname:portnumber/databasename',
		'dsn' => 'mongodb://yii2:yii2admin@127.0.0.1:27017/yii2',  
    # Create a database user with read and write access to the database:
		# use dbname ;   
		# db.createUser({user: "dbuser", pwd: "dbuseradmin", roles:[{role: "readWrite", db: "dbname"}] })  
    # Database user login:
		# mongo dbname -u dbuser -p dbduseradmin  
	]  
