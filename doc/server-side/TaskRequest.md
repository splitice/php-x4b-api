TaskRequest API Module
---

## TaskRequest::**summaryRow**
method not documented

## TaskRequest::**bulk**
method not documented

## TaskRequest::**insert**
Synonym for Create

* **URL**: https://www.x4b.net/apiv2/TaskRequest/insert
* **URL Params**: see create
* **Returns**: see create
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## TaskRequest::**create**
Create a new TaskRequest object

* **URL**: https://www.x4b.net/apiv2/TaskRequest/create
* **URL Params**: 

* **Returns**: 
```
{
    "status": "ok"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## TaskRequest::**get**
Get the value of a TaskRequest object matching a query

* **URL**: https://www.x4b.net/apiv2/TaskRequest/get
* **URL Params**: 

    **query[id]** - int: ID of the Task Request object

    **query[lease]** - not documented

    **query[result]** - not documented

    **query[complete]** - not documented

* **Returns**: 
```
{
    "id": "int: ID of the Task Request object",
    "lease": "not documented",
    "result": "not documented",
    "complete": "not documented"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## TaskRequest::**update**
Change the values in a TaskRequest object

* **URL**: https://www.x4b.net/apiv2/TaskRequest/update
* **URL Params**: 

    **query[id]** - int: ID of the Task Request object

    **query[lease]** - not documented

    **query[result]** - not documented

    **query[complete]** - not documented

* **Returns**: 
```
{
    "id": "int: ID of the Task Request object",
    "lease": "not documented",
    "result": "not documented",
    "complete": "not documented"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## TaskRequest::**delete**
Delete a TaskRequest object matching a query

* **URL**: https://www.x4b.net/apiv2/TaskRequest/delete
* **URL Params**: 

    **query[id]** - int: ID of the Task Request object

    **query[lease]** - not documented

    **query[result]** - not documented

    **query[complete]** - not documented

* **Returns**: 
```
{
    "status": "ok"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## TaskRequest::**all**
Get the value of a TaskRequest objects matching a query

* **URL**: https://www.x4b.net/apiv2/TaskRequest/all
* **URL Params**: 

    **query[id]** - int: ID of the Task Request object

    **query[lease]** - not documented

    **query[result]** - not documented

    **query[complete]** - not documented

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Task Request object",
        "lease": "not documented",
        "result": "not documented",
        "complete": "not documented"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## TaskRequest::**describe**
Provides any available description for the TaskRequest API module

* **URL**: https://www.x4b.net/apiv2/TaskRequest/describe
* **URL Params**: 

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## TaskRequest::**tableRow**
method not documented

