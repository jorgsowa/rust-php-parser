===source===
<?php
list(, $b, &$this) = $a;
===errors===
Cannot re-assign $this
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "this"
                          },
                          "span": {
                            "start": 18,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 23
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 24
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 27,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
