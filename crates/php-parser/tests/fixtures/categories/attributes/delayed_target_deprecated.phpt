===source===
<?php

#[DelayedTargetValidation]
#[Deprecated]
interface DemoInterface {}

#[DelayedTargetValidation]
#[Deprecated]
class DemoClass {}

#[DelayedTargetValidation]
#[Deprecated]
enum DemoEnum {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===errors 8.4===
Cannot apply #[\Deprecated] to interface DemoInterface
Cannot apply #[\Deprecated] to class DemoClass
Cannot apply #[\Deprecated] to enum DemoEnum
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'DemoEnum' (T_STRING) in Standard input code on line 13
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 13
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 5
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 58,
              "end": 71
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 48,
        "end": 74
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 123,
              "end": 132
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
        "start": 117,
        "end": 135
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 183,
              "end": 191
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 178,
        "end": 194
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 194
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 58,
              "end": 71
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
                  "start": 9,
                  "end": 32
                }
              },
              "args": [],
              "span": {
                "start": 9,
                "end": 32
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 46
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 46
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 74
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 123,
              "end": 132
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
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 78,
                  "end": 101
                }
              },
              "args": [],
              "span": {
                "start": 78,
                "end": 101
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 105,
                  "end": 115
                }
              },
              "args": [],
              "span": {
                "start": 105,
                "end": 115
              }
            }
          ]
        }
      },
      "span": {
        "start": 76,
        "end": 135
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 183,
              "end": 191
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 139,
                  "end": 162
                }
              },
              "args": [],
              "span": {
                "start": 139,
                "end": 162
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 166,
                  "end": 176
                }
              },
              "args": [],
              "span": {
                "start": 166,
                "end": 176
              }
            }
          ]
        }
      },
      "span": {
        "start": 137,
        "end": 194
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 194
  }
}
