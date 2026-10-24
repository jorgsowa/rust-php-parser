===description===
Attributes added after the target version are ordinary classes, so they are not checked.
===source===
<?php
#[Override] class A {}
#[Deprecated] class B {}
#[NoDiscard] class C {}
#[Deprecated] #[Deprecated] function f() {}
#[DelayedTargetValidation] interface I {}
===errors 8.3===
Attribute "Override" cannot target class (allowed targets: method)
===errors 8.4===
Attribute "Override" cannot target class (allowed targets: method)
Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant)
Attribute "Deprecated" must not be repeated
===errors 8.5===
Attribute "Override" cannot target class (allowed targets: method, property)
Cannot apply #[\Deprecated] to class B
Attribute "NoDiscard" cannot target class (allowed targets: function, method)
Attribute "Deprecated" must not be repeated
===errors >=8.6===
Attribute "Override" cannot target class (allowed targets: method, property, class constant)
Cannot apply #[\Deprecated] to class B
Attribute "NoDiscard" cannot target class (allowed targets: function, method)
Attribute "Deprecated" must not be repeated
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target class (allowed targets: method) in Standard input code on line 2
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target class (allowed targets: method, property) in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Attribute "Override" cannot target class (allowed targets: method, property, class constant) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 163
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
              "start": 24,
              "end": 25
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "Override"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 16
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 16
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 49,
              "end": 50
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 31,
                  "end": 41
                }
              },
              "args": [],
              "span": {
                "start": 31,
                "end": 41
              }
            }
          ]
        }
      },
      "span": {
        "start": 29,
        "end": 53
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 73,
              "end": 74
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 56,
                  "end": 65
                }
              },
              "args": [],
              "span": {
                "start": 56,
                "end": 65
              }
            }
          ]
        }
      },
      "span": {
        "start": 54,
        "end": 77
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 115,
              "end": 116
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 80,
                  "end": 90
                }
              },
              "args": [],
              "span": {
                "start": 80,
                "end": 90
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 94,
                  "end": 104
                }
              },
              "args": [],
              "span": {
                "start": 94,
                "end": 104
              }
            }
          ]
        }
      },
      "span": {
        "start": 78,
        "end": 121
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 159,
              "end": 160
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 124,
                  "end": 147
                }
              },
              "args": [],
              "span": {
                "start": 124,
                "end": 147
              }
            }
          ]
        }
      },
      "span": {
        "start": 122,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}
