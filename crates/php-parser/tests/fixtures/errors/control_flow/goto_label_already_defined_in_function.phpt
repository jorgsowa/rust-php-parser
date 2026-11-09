===source===
<?php
function f() {
    b:
    if (true) {
        b:
    }
}
===errors===
Label 'b' already defined
===php_error===
PHP Fatal error:  Label 'b' already defined in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Label": {
                  "name": "b",
                  "span": {
                    "start": 25,
                    "end": 26
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 27
              }
            },
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 36,
                      "end": 40
                    }
                  },
                  "then_branch": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Label": {
                              "name": "b",
                              "span": {
                                "start": 52,
                                "end": 53
                              }
                            }
                          },
                          "span": {
                            "start": 52,
                            "end": 54
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 42,
                      "end": 60
                    }
                  },
                  "elseif_branches": [],
                  "else_branch": null
                }
              },
              "span": {
                "start": 32,
                "end": 60
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
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
