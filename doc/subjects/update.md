# Update subject

Update a specific subject identified by an ID.

```
PUT /subjects/:id
```

Parameters:

- `id` (required) - The ID of a subject
- `name` (required) - The name of a subject
- `shortcut` (required) - The shortcut of a subject
- `archived` (required) - Boolean whether a subject is archived (true|false)

## Success

HTTP status: `204 No Content`

## Failure

### Parameter(s) missing in request

HTTP status: `400 Bad Request`

```json
{
	"missing": [
		"id",
		"name",
		"archived"
	]
}
```

### 3201: The parameter archived may only contain true or false.

HTTP status: `400 Conflict`

Error code: `3201`
> The parameter archived may only contain true or false

### 3302: A subject with the given name already exists.

HTTP status: `400 Bad Request`

Error code: `3302`
> A subject with the given name already exists.

### 3303: A subject with the given shortcut already exists.

HTTP status: `400 Bad Request`

Error code: `3303`
> A subject with the given shortcut already exists.

### 3200: The subject could not get updated.

HTTP status: `409 Conflict`

Error code: `3200`
> The subject could not get updated.
