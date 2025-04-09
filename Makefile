SAIL_ENTRY = vendor/bin/sail
up:
	${SAIL_ENTRY} up -d
	${SAIL_ENTRY} artisan migrate
	${SAIL_ENTRY} artisan optimize:clear

down:
	${SAIL_ENTRY} down
