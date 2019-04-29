PortBackend API Module
---

## PortBackend::**bulk**
method not documented

## PortBackend::**create**
Create a new PortBackend object

* **URL**: https://www.x4b.net/apiv2/PortBackend/create
* **URL Params**: 

    **value[port]** - string: the port this backend belongs to

    **value[to]** - structure of members that make up the destination component (backend server and port)

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
## PortBackend::**insert**
Synonym for Create

* **URL**: https://www.x4b.net/apiv2/PortBackend/insert
* **URL Params**: see create
* **Returns**: see create
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## PortBackend::**get**
Get the value of a PortBackend object matching a query

* **URL**: https://www.x4b.net/apiv2/PortBackend/get
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

    **query[to]** - not documented

* **Returns**: 
```
{
    "id": "int: ID of the Port Backend object",
    "port": "string: the port this backend belongs to",
    "to": "structure of members that make up the destination component (backend server and port)"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## PortBackend::**update**
Change the values in a PortBackend object

* **URL**: https://www.x4b.net/apiv2/PortBackend/update
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

    **query[to]** - not documented

    **value[port]** - string: the port this backend belongs to

    **value[to]** - structure of members that make up the destination component (backend server and port)

* **Returns**: 
```
{
    "id": "int: ID of the Port Backend object",
    "port": "string: the port this backend belongs to",
    "to": "structure of members that make up the destination component (backend server and port)"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## PortBackend::**delete**
Delete a PortBackend object matching a query

* **URL**: https://www.x4b.net/apiv2/PortBackend/delete
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

    **query[to]** - not documented

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
## PortBackend::**all**
Get the value of a PortBackend objects matching a query

* **URL**: https://www.x4b.net/apiv2/PortBackend/all
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

    **query[to]** - not documented

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Port Backend object",
        "port": "string: the port this backend belongs to",
        "to": "structure of members that make up the destination component (backend server and port)"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## PortBackend::**describe**
Provides any available description for the PortBackend API module

* **URL**: https://www.x4b.net/apiv2/PortBackend/describe
* **URL Params**: 

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
