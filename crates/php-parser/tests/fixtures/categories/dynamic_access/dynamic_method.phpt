===source===
<?php $obj->$method();
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
                  "Variable": "method"
                },
                "span": {
                  "start": 12,
                  "end": 19
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
