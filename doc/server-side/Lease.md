Lease API Module
---

## Lease::**all**
Get the value of a Lease objects matching a query

* **URL**: https://www.x4b.net/apiv2/Lease/all
* **URL Params**: 

    **query[id]** - int: ID of the Lease object (optional for query)

    **query[service]** - int: ID of the Service object

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Lease object (optional for query)",
        "type": "not documented",
        "current_usage": "not documented",
        "status": "not documented",
        "service": "int: ID of the Service object",
        "plan": "object: matching the syntax of the Plan module"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
