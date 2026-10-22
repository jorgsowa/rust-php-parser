===source===
<?php

#[DelayedTargetValidation]
#[Attribute]
trait DemoTrait {}

#[DelayedTargetValidation]
#[Attribute]
interface DemoInterface {}

#[DelayedTargetValidation]
#[Attribute]
abstract class DemoAbstract {}

#[DelayedTargetValidation]
#[Attribute]
enum DemoEnum {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'DemoEnum' (T_STRING) in Standard input code on line 17
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 17
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "DemoTrait",
            "span": {
              "start": 53,
              "end": 62
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 47,
        "end": 65
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 117,
              "end": 130
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 107,
        "end": 133
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoAbstract",
            "span": {
              "start": 190,
              "end": 202
            }
          },
          "modifiers": {
            "is_abstract": true,
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
        "start": 184,
        "end": 205
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 252,
              "end": 260
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 247,
        "end": 263
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 263
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "DemoTrait",
            "span": {
              "start": 53,
              "end": 62
            }
          },
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
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 45
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 47,
        "end": 65
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 117,
              "end": 130
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
                  "start": 69,
                  "end": 92
                }
              },
              "args": [],
              "span": {
                "start": 69,
                "end": 92
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 96,
                  "end": 105
                }
              },
              "args": [],
              "span": {
                "start": 96,
                "end": 105
              }
            }
          ]
        }
      },
      "span": {
        "start": 107,
        "end": 133
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoAbstract",
            "span": {
              "start": 190,
              "end": 202
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                  "start": 137,
                  "end": 160
                }
              },
              "args": [],
              "span": {
                "start": 137,
                "end": 160
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 164,
                  "end": 173
                }
              },
              "args": [],
              "span": {
                "start": 164,
                "end": 173
              }
            }
          ]
        }
      },
      "span": {
        "start": 184,
        "end": 205
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 252,
              "end": 260
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
                  "start": 209,
                  "end": 232
                }
              },
              "args": [],
              "span": {
                "start": 209,
                "end": 232
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 236,
                  "end": 245
                }
              },
              "args": [],
              "span": {
                "start": 236,
                "end": 245
              }
            }
          ]
        }
      },
      "span": {
        "start": 247,
        "end": 263
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 263
  }
}
