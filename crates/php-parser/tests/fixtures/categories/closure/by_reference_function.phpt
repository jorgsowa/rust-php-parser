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
          "name": {
            "name": "getRef",
            "span": {
              "start": 16,
              "end": 22
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "val",
                      "span": {
                        "start": 38,
                        "end": 42
                      }
                    },
                    "default": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 45,
                        "end": 46
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 46
                    }
                  }
                ]
              },
              "span": {
                "start": 31,
                "end": 47
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
                    "end": 63
                  }
                }
              },
              "span": {
                "start": 52,
                "end": 64
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
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
