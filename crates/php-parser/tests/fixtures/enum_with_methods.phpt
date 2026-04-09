===config===
min_php=8.1
===source===
<?php
enum Suit: string implements HasColor {
    case Hearts = 'H';
    case Diamonds = 'D';
    case Clubs = 'C';
    case Spades = 'S';

    const COUNT = 4;

    public function color(): string {
        return match ($this) {
            Suit::Hearts, Suit::Diamonds => 'red',
            Suit::Clubs, Suit::Spades => 'black',
        };
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 24,
              "start_line": 2,
              "start_col": 11
            }
          },
          "implements": [
            {
              "parts": [
                "HasColor"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 35,
                "end": 44,
                "start_line": 2,
                "start_col": 29
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Hearts",
                  "value": {
                    "kind": {
                      "String": "H"
                    },
                    "span": {
                      "start": 64,
                      "end": 67,
                      "start_line": 3,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 50,
                "end": 73,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Diamonds",
                  "value": {
                    "kind": {
                      "String": "D"
                    },
                    "span": {
                      "start": 89,
                      "end": 92,
                      "start_line": 4,
                      "start_col": 20
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 73,
                "end": 98,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Clubs",
                  "value": {
                    "kind": {
                      "String": "C"
                    },
                    "span": {
                      "start": 111,
                      "end": 114,
                      "start_line": 5,
                      "start_col": 17
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 120,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Spades",
                  "value": {
                    "kind": {
                      "String": "S"
                    },
                    "span": {
                      "start": 134,
                      "end": 137,
                      "start_line": 6,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 120,
                "end": 144,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "COUNT",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 158,
                      "end": 159,
                      "start_line": 8,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 144,
                "end": 166,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "color",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 191,
                          "end": 197,
                          "start_line": 10,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 191,
                      "end": 197,
                      "start_line": 10,
                      "start_col": 29
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Match": {
                              "subject": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 222,
                                  "end": 227,
                                  "start_line": 11,
                                  "start_col": 22
                                }
                              },
                              "arms": [
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Suit"
                                            },
                                            "span": {
                                              "start": 243,
                                              "end": 247,
                                              "start_line": 12,
                                              "start_col": 12
                                            }
                                          },
                                          "member": "Hearts"
                                        }
                                      },
                                      "span": {
                                        "start": 243,
                                        "end": 255,
                                        "start_line": 12,
                                        "start_col": 12
                                      }
                                    },
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Suit"
                                            },
                                            "span": {
                                              "start": 257,
                                              "end": 261,
                                              "start_line": 12,
                                              "start_col": 26
                                            }
                                          },
                                          "member": "Diamonds"
                                        }
                                      },
                                      "span": {
                                        "start": 257,
                                        "end": 272,
                                        "start_line": 12,
                                        "start_col": 26
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "red"
                                    },
                                    "span": {
                                      "start": 275,
                                      "end": 280,
                                      "start_line": 12,
                                      "start_col": 44
                                    }
                                  },
                                  "span": {
                                    "start": 243,
                                    "end": 280,
                                    "start_line": 12,
                                    "start_col": 12
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Suit"
                                            },
                                            "span": {
                                              "start": 294,
                                              "end": 298,
                                              "start_line": 13,
                                              "start_col": 12
                                            }
                                          },
                                          "member": "Clubs"
                                        }
                                      },
                                      "span": {
                                        "start": 294,
                                        "end": 305,
                                        "start_line": 13,
                                        "start_col": 12
                                      }
                                    },
                                    {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Suit"
                                            },
                                            "span": {
                                              "start": 307,
                                              "end": 311,
                                              "start_line": 13,
                                              "start_col": 25
                                            }
                                          },
                                          "member": "Spades"
                                        }
                                      },
                                      "span": {
                                        "start": 307,
                                        "end": 320,
                                        "start_line": 13,
                                        "start_col": 25
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "black"
                                    },
                                    "span": {
                                      "start": 323,
                                      "end": 330,
                                      "start_line": 13,
                                      "start_col": 41
                                    }
                                  },
                                  "span": {
                                    "start": 294,
                                    "end": 330,
                                    "start_line": 13,
                                    "start_col": 12
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 215,
                            "end": 341,
                            "start_line": 11,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 208,
                        "end": 347,
                        "start_line": 11,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 166,
                "end": 349,
                "start_line": 10,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 350,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 350,
    "start_line": 1,
    "start_col": 0
  }
}
