===source===
<?php
function foo() {
    static $a = 0, $b = 'init', $c = [];
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": "a",
                    "default": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 39,
                        "end": 40,
                        "start_line": 3,
                        "start_col": 16
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 40,
                      "start_line": 3,
                      "start_col": 11
                    }
                  },
                  {
                    "name": "b",
                    "default": {
                      "kind": {
                        "String": "init"
                      },
                      "span": {
                        "start": 47,
                        "end": 53,
                        "start_line": 3,
                        "start_col": 24
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 53,
                      "start_line": 3,
                      "start_col": 19
                    }
                  },
                  {
                    "name": "c",
                    "default": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 60,
                        "end": 62,
                        "start_line": 3,
                        "start_col": 37
                      }
                    },
                    "span": {
                      "start": 55,
                      "end": 62,
                      "start_line": 3,
                      "start_col": 32
                    }
                  }
                ]
              },
              "span": {
                "start": 27,
                "end": 64,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 65,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65,
    "start_line": 1,
    "start_col": 0
  }
}
