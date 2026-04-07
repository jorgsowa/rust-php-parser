===config===
min_php=8.1
===source===
<?php $r = match($status) { Status::Active, Status::Pending => 'live', Status::Inactive => 'off' };
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
                  "Variable": "r"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "status"
                      },
                      "span": {
                        "start": 17,
                        "end": 24
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
                                    "Identifier": "Status"
                                  },
                                  "span": {
                                    "start": 28,
                                    "end": 34
                                  }
                                },
                                "member": "Active"
                              }
                            },
                            "span": {
                              "start": 28,
                              "end": 42
                            }
                          },
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "Status"
                                  },
                                  "span": {
                                    "start": 44,
                                    "end": 50
                                  }
                                },
                                "member": "Pending"
                              }
                            },
                            "span": {
                              "start": 44,
                              "end": 60
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "live"
                          },
                          "span": {
                            "start": 63,
                            "end": 69
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 69
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "Status"
                                  },
                                  "span": {
                                    "start": 71,
                                    "end": 77
                                  }
                                },
                                "member": "Inactive"
                              }
                            },
                            "span": {
                              "start": 71,
                              "end": 88
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "off"
                          },
                          "span": {
                            "start": 91,
                            "end": 96
                          }
                        },
                        "span": {
                          "start": 71,
                          "end": 96
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 98
          }
        }
      },
      "span": {
        "start": 6,
        "end": 99
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99
  }
}
