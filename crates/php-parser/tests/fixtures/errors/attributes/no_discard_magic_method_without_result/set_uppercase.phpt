===source===
<?php
class A {
    #[\NoDiscard] public function __SET($a, $b) {}
}
===errors >=8.5===
Method A::__SET cannot be #[\NoDiscard]
===php_error >=8.5===
PHP Fatal error:  Method A::__SET cannot be #[\NoDiscard] in Standard input code on line 3
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
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
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
                    "name": "__SET",
                    "span": {
                      "start": 50,
                      "end": 55
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
                          "start": 56,
                          "end": 58
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 56,
                        "end": 58
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 60,
                          "end": 62
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 60,
                        "end": 62
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
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
