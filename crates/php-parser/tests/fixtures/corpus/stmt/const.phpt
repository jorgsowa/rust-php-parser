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
===errors===
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "A",
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
            "name": "B",
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
            "name": "C",
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
            "name": "D",
            "value": {
              "kind": {
                "Identifier": "E"
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
        "end": 46
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "WithOneAttribute",
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
        "end": 86
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "WithUngroupedAttriutes",
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
        "end": 140
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "WithGroupAttributes",
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
        "end": 189
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "ThisIsInvalid",
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
            "name": "AttributesOnMultipleConstants",
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
