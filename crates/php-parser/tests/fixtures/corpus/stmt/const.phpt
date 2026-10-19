===source===
<?php

const A = 0, B = 1.0, C = 'A', D = E;

#[Example]
const WithOneAttribute = 1;

#[First]
#[Second]
const WithUngroupedAttriutes = 2;

#[First, Second]
const WithGroupAttributes = 3;

#[Example]
const ThisIsInvalid = 4,
    AttributesOnMultipleConstants = 5;
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'attributes on constants' requires PHP 8.5 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes on constants' requires PHP 8.5 or higher
'attributes' requires PHP 8.0 or higher
'attributes on constants' requires PHP 8.5 or higher
'attributes' requires PHP 8.0 or higher
'attributes on constants' requires PHP 8.5 or higher
Cannot apply attributes to multiple constants at once
===errors 8.0-8.4===
'attributes on constants' requires PHP 8.5 or higher
'attributes on constants' requires PHP 8.5 or higher
'attributes on constants' requires PHP 8.5 or higher
'attributes on constants' requires PHP 8.5 or higher
Cannot apply attributes to multiple constants at once
===errors >=8.5===
Cannot apply attributes to multiple constants at once
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 6
===php_error >=8.5===
PHP Fatal error:  Cannot apply attributes to multiple constants at once in Standard input code on line 16
===ast >=7.4===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 13,
                "end": 14
              }
            },
            "value": {
              "kind": {
                "Int": 0
              },
              "span": {
                "start": 17,
                "end": 18
              }
            },
            "attributes": [],
            "span": {
              "start": 13,
              "end": 18
            }
          },
          {
            "name": {
              "name": "B",
              "span": {
                "start": 20,
                "end": 21
              }
            },
            "value": {
              "kind": {
                "Float": 1.0
              },
              "span": {
                "start": 24,
                "end": 27
              }
            },
            "attributes": [],
            "span": {
              "start": 20,
              "end": 27
            }
          },
          {
            "name": {
              "name": "C",
              "span": {
                "start": 29,
                "end": 30
              }
            },
            "value": {
              "kind": {
                "String": "A"
              },
              "span": {
                "start": 33,
                "end": 36
              }
            },
            "attributes": [],
            "span": {
              "start": 29,
              "end": 36
            }
          },
          {
            "name": {
              "name": "D",
              "span": {
                "start": 38,
                "end": 39
              }
            },
            "value": {
              "kind": {
                "Name": {
                  "parts": [
                    "E"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 42,
                    "end": 43
                  }
                }
              },
              "span": {
                "start": 42,
                "end": 43
              }
            },
            "attributes": [],
            "span": {
              "start": 38,
              "end": 43
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 44
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "WithOneAttribute",
              "span": {
                "start": 63,
                "end": 79
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 82,
                "end": 83
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "Example"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 48,
                    "end": 55
                  }
                },
                "args": [],
                "span": {
                  "start": 48,
                  "end": 55
                }
              }
            ],
            "span": {
              "start": 63,
              "end": 83
            }
          }
        ]
      },
      "span": {
        "start": 57,
        "end": 84
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "WithUngroupedAttriutes",
              "span": {
                "start": 111,
                "end": 133
              }
            },
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 136,
                "end": 137
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "First"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 88,
                    "end": 93
                  }
                },
                "args": [],
                "span": {
                  "start": 88,
                  "end": 93
                }
              },
              {
                "name": {
                  "parts": [
                    "Second"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 97,
                    "end": 103
                  }
                },
                "args": [],
                "span": {
                  "start": 97,
                  "end": 103
                }
              }
            ],
            "span": {
              "start": 111,
              "end": 137
            }
          }
        ]
      },
      "span": {
        "start": 105,
        "end": 138
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "WithGroupAttributes",
              "span": {
                "start": 163,
                "end": 182
              }
            },
            "value": {
              "kind": {
                "Int": 3
              },
              "span": {
                "start": 185,
                "end": 186
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "First"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 142,
                    "end": 147
                  }
                },
                "args": [],
                "span": {
                  "start": 142,
                  "end": 147
                }
              },
              {
                "name": {
                  "parts": [
                    "Second"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 149,
                    "end": 155
                  }
                },
                "args": [],
                "span": {
                  "start": 149,
                  "end": 155
                }
              }
            ],
            "span": {
              "start": 163,
              "end": 186
            }
          }
        ]
      },
      "span": {
        "start": 157,
        "end": 187
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "ThisIsInvalid",
              "span": {
                "start": 206,
                "end": 219
              }
            },
            "value": {
              "kind": {
                "Int": 4
              },
              "span": {
                "start": 222,
                "end": 223
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "Example"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 191,
                    "end": 198
                  }
                },
                "args": [],
                "span": {
                  "start": 191,
                  "end": 198
                }
              }
            ],
            "span": {
              "start": 206,
              "end": 223
            }
          },
          {
            "name": {
              "name": "AttributesOnMultipleConstants",
              "span": {
                "start": 229,
                "end": 258
              }
            },
            "value": {
              "kind": {
                "Int": 5
              },
              "span": {
                "start": 261,
                "end": 262
              }
            },
            "attributes": [],
            "span": {
              "start": 229,
              "end": 262
            }
          }
        ]
      },
      "span": {
        "start": 200,
        "end": 263
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 263
  }
}
