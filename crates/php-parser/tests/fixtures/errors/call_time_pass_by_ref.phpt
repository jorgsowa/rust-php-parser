===source===
<?php sort(&$arr);
===errors===
call-time pass-by-reference is not allowed
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "sort"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 12,
                      "end": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": true,
                  "span": {
                    "start": 11,
                    "end": 16
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
