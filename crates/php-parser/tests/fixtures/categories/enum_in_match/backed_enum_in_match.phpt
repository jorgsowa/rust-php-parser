===config===
min_php=8.1
===source===
<?php enum Color: string { case Red = 'red'; case Blue = 'blue'; } $r = match($c) { Color::Red => 1, Color::Blue => 2, default => 0 };
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Color",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 18,
              "end": 24
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Red",
                  "value": {
                    "kind": {
                      "String": "red"
                    },
                    "span": {
                      "start": 38,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 44
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Blue",
                  "value": {
                    "kind": {
                      "String": "blue"
                    },
                    "span": {
                      "start": 57,
                      "end": 63
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 45,
                "end": 64
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r"
                },
                "span": {
                  "start": 67,
                  "end": 69
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 78,
                        "end": 80
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
                                    "Identifier": "Color"
                                  },
                                  "span": {
                                    "start": 84,
                                    "end": 89
                                  }
                                },
                                "member": "Red"
                              }
                            },
                            "span": {
                              "start": 84,
                              "end": 94
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 98,
                            "end": 99
                          }
                        },
                        "span": {
                          "start": 84,
                          "end": 99
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "Color"
                                  },
                                  "span": {
                                    "start": 101,
                                    "end": 106
                                  }
                                },
                                "member": "Blue"
                              }
                            },
                            "span": {
                              "start": 101,
                              "end": 112
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 116,
                            "end": 117
                          }
                        },
                        "span": {
                          "start": 101,
                          "end": 117
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 130,
                            "end": 131
                          }
                        },
                        "span": {
                          "start": 119,
                          "end": 131
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 72,
                  "end": 133
                }
              }
            }
          },
          "span": {
            "start": 67,
            "end": 133
          }
        }
      },
      "span": {
        "start": 67,
        "end": 134
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134
  }
}
