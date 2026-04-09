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
                "end": 18,
                "start_line": 3,
                "start_col": 10
              }
            },
            "attributes": [],
            "span": {
              "start": 13,
              "end": 18,
              "start_line": 3,
              "start_col": 6
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
                "end": 27,
                "start_line": 3,
                "start_col": 17
              }
            },
            "attributes": [],
            "span": {
              "start": 20,
              "end": 27,
              "start_line": 3,
              "start_col": 13
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
                "end": 36,
                "start_line": 3,
                "start_col": 26
              }
            },
            "attributes": [],
            "span": {
              "start": 29,
              "end": 36,
              "start_line": 3,
              "start_col": 22
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
                "end": 43,
                "start_line": 3,
                "start_col": 35
              }
            },
            "attributes": [],
            "span": {
              "start": 38,
              "end": 43,
              "start_line": 3,
              "start_col": 31
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 46,
        "start_line": 3,
        "start_col": 0
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
                "end": 83,
                "start_line": 6,
                "start_col": 25
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
                    "end": 55,
                    "start_line": 5,
                    "start_col": 2
                  }
                },
                "args": [],
                "span": {
                  "start": 48,
                  "end": 55,
                  "start_line": 5,
                  "start_col": 2
                }
              }
            ],
            "span": {
              "start": 63,
              "end": 83,
              "start_line": 6,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 57,
        "end": 86,
        "start_line": 6,
        "start_col": 0
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
                "end": 137,
                "start_line": 10,
                "start_col": 31
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
                    "end": 93,
                    "start_line": 8,
                    "start_col": 2
                  }
                },
                "args": [],
                "span": {
                  "start": 88,
                  "end": 93,
                  "start_line": 8,
                  "start_col": 2
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
                    "end": 103,
                    "start_line": 9,
                    "start_col": 2
                  }
                },
                "args": [],
                "span": {
                  "start": 97,
                  "end": 103,
                  "start_line": 9,
                  "start_col": 2
                }
              }
            ],
            "span": {
              "start": 111,
              "end": 137,
              "start_line": 10,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 105,
        "end": 140,
        "start_line": 10,
        "start_col": 0
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
                "end": 186,
                "start_line": 13,
                "start_col": 28
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
                    "end": 147,
                    "start_line": 12,
                    "start_col": 2
                  }
                },
                "args": [],
                "span": {
                  "start": 142,
                  "end": 147,
                  "start_line": 12,
                  "start_col": 2
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
                    "end": 155,
                    "start_line": 12,
                    "start_col": 9
                  }
                },
                "args": [],
                "span": {
                  "start": 149,
                  "end": 155,
                  "start_line": 12,
                  "start_col": 9
                }
              }
            ],
            "span": {
              "start": 163,
              "end": 186,
              "start_line": 13,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 157,
        "end": 189,
        "start_line": 13,
        "start_col": 0
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
                "end": 223,
                "start_line": 16,
                "start_col": 22
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
                    "end": 198,
                    "start_line": 15,
                    "start_col": 2
                  }
                },
                "args": [],
                "span": {
                  "start": 191,
                  "end": 198,
                  "start_line": 15,
                  "start_col": 2
                }
              }
            ],
            "span": {
              "start": 206,
              "end": 223,
              "start_line": 16,
              "start_col": 6
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
                "end": 262,
                "start_line": 17,
                "start_col": 36
              }
            },
            "attributes": [],
            "span": {
              "start": 229,
              "end": 262,
              "start_line": 17,
              "start_col": 4
            }
          }
        ]
      },
      "span": {
        "start": 200,
        "end": 263,
        "start_line": 16,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 263,
    "start_line": 1,
    "start_col": 0
  }
}
