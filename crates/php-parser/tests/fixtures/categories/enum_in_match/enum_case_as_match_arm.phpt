===config===
min_php=8.1
===source===
<?php enum Status { case Active; case Inactive; } $r = match($s) { Status::Active => 'on', Status::Inactive => 'off' };
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 25,
                      "end": 31
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 38,
                      "end": 46
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
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
                  "start": 50,
                  "end": 52
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "s"
                      },
                      "span": {
                        "start": 61,
                        "end": 63
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
                                    "Name": {
                                      "parts": [
                                        "Status"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 67,
                                        "end": 73
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 67,
                                    "end": 73
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "Active"
                                  },
                                  "span": {
                                    "start": 75,
                                    "end": 81
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 67,
                              "end": 81
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "on"
                          },
                          "span": {
                            "start": 85,
                            "end": 89
                          }
                        },
                        "span": {
                          "start": 67,
                          "end": 89
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "Status"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 91,
                                        "end": 97
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 91,
                                    "end": 97
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "Inactive"
                                  },
                                  "span": {
                                    "start": 99,
                                    "end": 107
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 91,
                              "end": 107
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "off"
                          },
                          "span": {
                            "start": 111,
                            "end": 116
                          }
                        },
                        "span": {
                          "start": 91,
                          "end": 116
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 55,
                  "end": 118
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 118
          }
        }
      },
      "span": {
        "start": 50,
        "end": 119
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119
  }
}
