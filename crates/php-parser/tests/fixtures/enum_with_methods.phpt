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
              "end": 23
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
                "end": 43
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
                      "end": 67
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 50,
                "end": 68
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
                      "end": 92
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 73,
                "end": 93
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
                      "end": 114
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 115
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
                      "end": 137
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 120,
                "end": 138
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
                      "end": 159
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 144,
                "end": 160
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
                          "end": 197
                        }
                      }
                    },
                    "span": {
                      "start": 191,
                      "end": 197
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
                                  "end": 227
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
                                              "end": 247
                                            }
                                          },
                                          "member": {
                                            "name": "Hearts",
                                            "span": {
                                              "start": 249,
                                              "end": 255
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 243,
                                        "end": 255
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
                                              "end": 261
                                            }
                                          },
                                          "member": {
                                            "name": "Diamonds",
                                            "span": {
                                              "start": 263,
                                              "end": 271
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 257,
                                        "end": 271
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "red"
                                    },
                                    "span": {
                                      "start": 275,
                                      "end": 280
                                    }
                                  },
                                  "span": {
                                    "start": 243,
                                    "end": 280
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
                                              "end": 298
                                            }
                                          },
                                          "member": {
                                            "name": "Clubs",
                                            "span": {
                                              "start": 300,
                                              "end": 305
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 294,
                                        "end": 305
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
                                              "end": 311
                                            }
                                          },
                                          "member": {
                                            "name": "Spades",
                                            "span": {
                                              "start": 313,
                                              "end": 319
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 307,
                                        "end": 319
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "black"
                                    },
                                    "span": {
                                      "start": 323,
                                      "end": 330
                                    }
                                  },
                                  "span": {
                                    "start": 294,
                                    "end": 330
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 215,
                            "end": 341
                          }
                        }
                      },
                      "span": {
                        "start": 208,
                        "end": 342
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 166,
                "end": 348
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 350
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 350
  }
}
