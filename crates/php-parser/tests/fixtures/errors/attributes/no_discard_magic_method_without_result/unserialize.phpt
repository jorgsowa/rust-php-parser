===source===
<?php
class A {
    #[\NoDiscard] public function __unserialize(array $a) {}
}
===errors >=8.5===
Method A::__unserialize cannot be #[\NoDiscard]
===php_error >=8.5===
PHP Fatal error:  Method A::__unserialize cannot be #[\NoDiscard] in Standard input code on line 3
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
        "end": 78
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 78
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
                    "name": "__unserialize",
                    "span": {
                      "start": 50,
                      "end": 63
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 70,
                          "end": 72
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 64,
                              "end": 69
                            }
                          }
                        },
                        "span": {
                          "start": 64,
                          "end": 69
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 64,
                        "end": 72
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 22,
                          "end": 32
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 32
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 76
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 78
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 78
  }
}
