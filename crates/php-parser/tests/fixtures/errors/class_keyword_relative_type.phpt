===source===
<?php
function f(namespace\self $a): namespace\static {}
function g(): namespace\parent|int {}
class A {
    function m(): namespace\parent {}
}
===errors===
Type declaration 'static' must be unqualified
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "parent" when current class scope has no parent
===php_error <=8.5===
PHP Fatal error:  Cannot use "static" when no class scope is active in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Type declaration 'static' must be unqualified in Standard input code on line 2
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
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 32,
                  "end": 34
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 17,
                      "end": 31
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 31
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 34
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "static"
                ],
                "kind": "Relative",
                "span": {
                  "start": 37,
                  "end": 53
                }
              }
            },
            "span": {
              "start": 37,
              "end": 53
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 66,
              "end": 67
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "parent"
                      ],
                      "kind": "Relative",
                      "span": {
                        "start": 71,
                        "end": 87
                      }
                    }
                  },
                  "span": {
                    "start": 71,
                    "end": 87
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 88,
                        "end": 91
                      }
                    }
                  },
                  "span": {
                    "start": 88,
                    "end": 91
                  }
                }
              ]
            },
            "span": {
              "start": 71,
              "end": 91
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 57,
        "end": 94
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 101,
              "end": 102
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
                    "name": "m",
                    "span": {
                      "start": 118,
                      "end": 119
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Relative",
                        "span": {
                          "start": 123,
                          "end": 139
                        }
                      }
                    },
                    "span": {
                      "start": 123,
                      "end": 139
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 109,
                "end": 142
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 95,
        "end": 144
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 144
  }
}
