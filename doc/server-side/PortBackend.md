PortBackend API Module
---

## create
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
## insert
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
## get
Get the value of a PortBackend object matching a query

* **URL**: https://www.x4b.net/apiv2/PortBackend/get
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

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
## update
Change the values in a PortBackend object

* **URL**: https://www.x4b.net/apiv2/PortBackend/update
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

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
## delete
Delete a PortBackend object matching a query

* **URL**: https://www.x4b.net/apiv2/PortBackend/delete
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

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
## all
Get the value of a PortBackend objects matching a query

* **URL**: https://www.x4b.net/apiv2/PortBackend/all
* **URL Params**: 

    **query[id]** - int: ID of the Port Backend object

    **query[port]** - string: the port this backend belongs to

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
## describe
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
