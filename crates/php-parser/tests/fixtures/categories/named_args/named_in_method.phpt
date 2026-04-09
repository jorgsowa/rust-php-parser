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
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 12,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 12
                }
              },
              "args": [
                {
                  "name": "key",
                  "value": {
                    "kind": {
                      "String": "val"
                    },
                    "span": {
                      "start": 24,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 24
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 19,
                    "end": 29,
                    "start_line": 1,
                    "start_col": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 30,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}
