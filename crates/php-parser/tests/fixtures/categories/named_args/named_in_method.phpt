===source===
<?php $obj->method(key: 'val');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 12,
                  "end": 18
                }
              },
              "args": [
                {
                  "name": {
                    "name": "key",
                    "span": {
                      "start": 19,
                      "end": 22
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "val"
                    },
                    "span": {
                      "start": 24,
                      "end": 29
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 19,
                    "end": 29
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
