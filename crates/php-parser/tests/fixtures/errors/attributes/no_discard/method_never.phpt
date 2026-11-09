===source===
<?php
class A {
    #[NoDiscard] public function n(): never { exit; }
}
===errors >=8.5===
A never returning method does not return a value, but #[\NoDiscard] requires a return value
===php_error >=8.5===
PHP Fatal error:  A never returning method does not return a value, but #[\NoDiscard] requires a return value in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 59
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Exit": null
                          },
                          "span": {
                            "start": 62,
                            "end": 66
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 67
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 31
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 31
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
