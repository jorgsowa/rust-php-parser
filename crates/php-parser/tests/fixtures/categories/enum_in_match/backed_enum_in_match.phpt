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
              "end": 25,
              "start_line": 1,
              "start_col": 18
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
                      "end": 43,
                      "start_line": 1,
                      "start_col": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 45,
                "start_line": 1,
                "start_col": 27
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
                      "end": 63,
                      "start_line": 1,
                      "start_col": 57
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 45,
                "end": 65,
                "start_line": 1,
                "start_col": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66,
        "start_line": 1,
        "start_col": 6
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
                  "end": 69,
                  "start_line": 1,
                  "start_col": 67
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
                        "end": 80,
                        "start_line": 1,
                        "start_col": 78
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
                                    "end": 89,
                                    "start_line": 1,
                                    "start_col": 84
                                  }
                                },
                                "member": "Red"
                              }
                            },
                            "span": {
                              "start": 84,
                              "end": 95,
                              "start_line": 1,
                              "start_col": 84
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 98,
                            "end": 99,
                            "start_line": 1,
                            "start_col": 98
                          }
                        },
                        "span": {
                          "start": 84,
                          "end": 99,
                          "start_line": 1,
                          "start_col": 84
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
                                    "end": 106,
                                    "start_line": 1,
                                    "start_col": 101
                                  }
                                },
                                "member": "Blue"
                              }
                            },
                            "span": {
                              "start": 101,
                              "end": 113,
                              "start_line": 1,
                              "start_col": 101
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 116,
                            "end": 117,
                            "start_line": 1,
                            "start_col": 116
                          }
                        },
                        "span": {
                          "start": 101,
                          "end": 117,
                          "start_line": 1,
                          "start_col": 101
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
                            "end": 131,
                            "start_line": 1,
                            "start_col": 130
                          }
                        },
                        "span": {
                          "start": 119,
                          "end": 131,
                          "start_line": 1,
                          "start_col": 119
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 72,
                  "end": 133,
                  "start_line": 1,
                  "start_col": 72
                }
              }
            }
          },
          "span": {
            "start": 67,
            "end": 133,
            "start_line": 1,
            "start_col": 67
          }
        }
      },
      "span": {
        "start": 67,
        "end": 134,
        "start_line": 1,
        "start_col": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134,
    "start_line": 1,
    "start_col": 0
  }
}
