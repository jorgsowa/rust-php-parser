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
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
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
                        "end": 24,
                        "start_line": 1,
                        "start_col": 17
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
                                    "end": 34,
                                    "start_line": 1,
                                    "start_col": 28
                                  }
                                },
                                "member": "Active"
                              }
                            },
                            "span": {
                              "start": 28,
                              "end": 42,
                              "start_line": 1,
                              "start_col": 28
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
                                    "end": 50,
                                    "start_line": 1,
                                    "start_col": 44
                                  }
                                },
                                "member": "Pending"
                              }
                            },
                            "span": {
                              "start": 44,
                              "end": 60,
                              "start_line": 1,
                              "start_col": 44
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "live"
                          },
                          "span": {
                            "start": 63,
                            "end": 69,
                            "start_line": 1,
                            "start_col": 63
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 69,
                          "start_line": 1,
                          "start_col": 28
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
                                    "end": 77,
                                    "start_line": 1,
                                    "start_col": 71
                                  }
                                },
                                "member": "Inactive"
                              }
                            },
                            "span": {
                              "start": 71,
                              "end": 88,
                              "start_line": 1,
                              "start_col": 71
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "off"
                          },
                          "span": {
                            "start": 91,
                            "end": 96,
                            "start_line": 1,
                            "start_col": 91
                          }
                        },
                        "span": {
                          "start": 71,
                          "end": 96,
                          "start_line": 1,
                          "start_col": 71
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 98,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 98,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 99,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99,
    "start_line": 1,
    "start_col": 0
  }
}
