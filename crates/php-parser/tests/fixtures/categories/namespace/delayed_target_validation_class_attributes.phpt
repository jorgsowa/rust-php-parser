===source===
<?php
#[DelayedTargetValidation] #[Attribute] trait T {}
#[DelayedTargetValidation] #[Deprecated] interface I {}
#[DelayedTargetValidation] #[AllowDynamicProperties] readonly class R {}
#[DelayedTargetValidation] #[Attribute] abstract class A {}
#[DelayedTargetValidation] #[Deprecated] enum E {}
===errors 8.0===
'readonly class' requires PHP 8.2 or higher
'enums' requires PHP 8.1 or higher
===errors 8.1===
'readonly class' requires PHP 8.2 or higher
===errors 8.2-8.3===
Cannot apply #[\AllowDynamicProperties] to readonly class R
===errors 8.4===
Cannot apply #[\Deprecated] to interface I
Cannot apply #[\AllowDynamicProperties] to readonly class R
Cannot apply #[\Deprecated] to enum E
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly" in Standard input code on line 4
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 4
===php_error 8.2-8.3===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to readonly class R in Standard input code on line 4
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 296
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 52,
              "end": 53
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
                  "start": 8,
                  "end": 31
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 31
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 35,
                  "end": 44
                }
              },
              "args": [],
              "span": {
                "start": 35,
                "end": 44
              }
            }
          ]
        }
      },
      "span": {
        "start": 46,
        "end": 56
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 108,
              "end": 109
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
                  "start": 59,
                  "end": 82
                }
              },
              "args": [],
              "span": {
                "start": 59,
                "end": 82
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 86,
                  "end": 96
                }
              },
              "args": [],
              "span": {
                "start": 86,
                "end": 96
              }
            }
          ]
        }
      },
      "span": {
        "start": 98,
        "end": 112
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "R",
            "span": {
              "start": 181,
              "end": 182
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
                  "start": 115,
                  "end": 138
                }
              },
              "args": [],
              "span": {
                "start": 115,
                "end": 138
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 142,
                  "end": 164
                }
              },
              "args": [],
              "span": {
                "start": 142,
                "end": 164
              }
            }
          ]
        }
      },
      "span": {
        "start": 175,
        "end": 185
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 241,
              "end": 242
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
                  "start": 188,
                  "end": 211
                }
              },
              "args": [],
              "span": {
                "start": 188,
                "end": 211
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 215,
                  "end": 224
                }
              },
              "args": [],
              "span": {
                "start": 215,
                "end": 224
              }
            }
          ]
        }
      },
      "span": {
        "start": 235,
        "end": 245
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 292,
              "end": 293
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
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 275,
                  "end": 285
                }
              },
              "args": [],
              "span": {
                "start": 275,
                "end": 285
              }
            }
          ]
        }
      },
      "span": {
        "start": 287,
        "end": 296
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 296
  }
}
