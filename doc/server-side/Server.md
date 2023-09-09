Server API Module
---

## Server::**bulk**
method not documented

## Server::**get**
Get the value of a Server object matching a query

* **URL**: https://www.x4b.net/apiv2/Server/get
* **URL Params**: 

    **query[id]** - int: ID of the Server object (optional for query)

* **Returns**: 
```
{
    "id": "int: ID of the Server object (optional for query)",
    "name": "string: the name of the server"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Server::**all**
Get the value of a Server objects matching a query

* **URL**: https://www.x4b.net/apiv2/Server/all
* **URL Params**: 

    **query[id]** - int: ID of the Server object (optional for query)

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Server object (optional for query)",
        "name": "string: the name of the server"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Server::**describe**
Provides any available description for the Server API module

* **URL**: https://www.x4b.net/apiv2/Server/describe
* **URL Params**: 

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
