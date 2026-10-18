===source===
<?php
$label = match (getStatus()) {
    isActive() => 'active',
    isPending() => 'pending',
    default => throw new LogicException('Unknown'),
};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "label"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "getStatus"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 22,
                                  "end": 31
                                }
                              }
                            },
                            "span": {
                              "start": 22,
                              "end": 31
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 33
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "isActive"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 41,
                                        "end": 49
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 41,
                                    "end": 49
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 51
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "active"
                          },
                          "span": {
                            "start": 55,
                            "end": 63
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 63
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "isPending"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 69,
                                        "end": 78
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 69,
                                    "end": 78
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 69,
                              "end": 80
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "pending"
                          },
                          "span": {
                            "start": 84,
                            "end": 93
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 93
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Throw": {
                              "kind": {
                                "New": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "LogicException"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 120,
                                          "end": 134
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 120,
                                      "end": 134
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "String": "Unknown"
                                        },
                                        "span": {
                                          "start": 135,
                                          "end": 144
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 135,
                                        "end": 144
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 116,
                                "end": 145
                              }
                            }
                          },
                          "span": {
                            "start": 110,
                            "end": 145
                          }
                        },
                        "span": {
                          "start": 99,
                          "end": 145
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 15,
                  "end": 148
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 148
          }
        }
      },
      "span": {
        "start": 6,
        "end": 149
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 149
  }
}
