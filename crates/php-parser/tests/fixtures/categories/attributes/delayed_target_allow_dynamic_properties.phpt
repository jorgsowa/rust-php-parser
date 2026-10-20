===source===
<?php

#[DelayedTargetValidation]
#[AllowDynamicProperties]
trait DemoTrait {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
interface DemoInterface {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
readonly class DemoReadonly {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
enum DemoEnum {}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly" in Standard input code on line 13
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 13
===php_error 8.2-8.3===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to trait in Standard input code on line 5
===php_error 8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to trait DemoTrait in Standard input code on line 5
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "DemoTrait",
            "span": {
              "start": 66,
              "end": 75
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
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 58
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 58
              }
            }
          ]
        }
      },
      "span": {
        "start": 60,
        "end": 78
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 143,
              "end": 156
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
                  "start": 82,
                  "end": 105
                }
              },
              "args": [],
              "span": {
                "start": 82,
                "end": 105
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 109,
                  "end": 131
                }
              },
              "args": [],
              "span": {
                "start": 109,
                "end": 131
              }
            }
          ]
        }
      },
      "span": {
        "start": 133,
        "end": 159
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoReadonly",
            "span": {
              "start": 229,
              "end": 241
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
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
                  "start": 163,
                  "end": 186
                }
              },
              "args": [],
              "span": {
                "start": 163,
                "end": 186
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 190,
                  "end": 212
                }
              },
              "args": [],
              "span": {
                "start": 190,
                "end": 212
              }
            }
          ]
        }
      },
      "span": {
        "start": 223,
        "end": 244
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 304,
              "end": 312
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
                  "start": 248,
                  "end": 271
                }
              },
              "args": [],
              "span": {
                "start": 248,
                "end": 271
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 275,
                  "end": 297
                }
              },
              "args": [],
              "span": {
                "start": 275,
                "end": 297
              }
            }
          ]
        }
      },
      "span": {
        "start": 299,
        "end": 315
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 315
  }
}
