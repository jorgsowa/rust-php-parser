===source===
<?php
function &getRef() {
    static $val = 0;
    return $val;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "getRef",
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": "val",
                    "default": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 45,
                        "end": 46,
                        "start_line": 3,
                        "start_col": 18
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 46,
                      "start_line": 3,
                      "start_col": 11
                    }
                  }
                ]
              },
              "span": {
                "start": 31,
                "end": 52,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "val"
                  },
                  "span": {
                    "start": 59,
                    "end": 63,
                    "start_line": 4,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 52,
                "end": 65,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66,
    "start_line": 1,
    "start_col": 0
  }
}
