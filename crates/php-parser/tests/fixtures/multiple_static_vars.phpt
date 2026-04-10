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
                        "end": 40
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 40
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
                        "end": 53
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 53
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
                        "end": 62
                      }
                    },
                    "span": {
                      "start": 55,
                      "end": 62
                    }
                  }
                ]
              },
              "span": {
                "start": 27,
                "end": 63
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
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
