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
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Active",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 33,
                "start_line": 1,
                "start_col": 20
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Inactive",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 48,
                "start_line": 1,
                "start_col": 33
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49,
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
                  "start": 50,
                  "end": 52,
                  "start_line": 1,
                  "start_col": 50
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
                        "end": 63,
                        "start_line": 1,
                        "start_col": 61
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
                                    "start": 67,
                                    "end": 73,
                                    "start_line": 1,
                                    "start_col": 67
                                  }
                                },
                                "member": "Active"
                              }
                            },
                            "span": {
                              "start": 67,
                              "end": 82,
                              "start_line": 1,
                              "start_col": 67
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "on"
                          },
                          "span": {
                            "start": 85,
                            "end": 89,
                            "start_line": 1,
                            "start_col": 85
                          }
                        },
                        "span": {
                          "start": 67,
                          "end": 89,
                          "start_line": 1,
                          "start_col": 67
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
                                    "start": 91,
                                    "end": 97,
                                    "start_line": 1,
                                    "start_col": 91
                                  }
                                },
                                "member": "Inactive"
                              }
                            },
                            "span": {
                              "start": 91,
                              "end": 108,
                              "start_line": 1,
                              "start_col": 91
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "off"
                          },
                          "span": {
                            "start": 111,
                            "end": 116,
                            "start_line": 1,
                            "start_col": 111
                          }
                        },
                        "span": {
                          "start": 91,
                          "end": 116,
                          "start_line": 1,
                          "start_col": 91
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 55,
                  "end": 118,
                  "start_line": 1,
                  "start_col": 55
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 118,
            "start_line": 1,
            "start_col": 50
          }
        }
      },
      "span": {
        "start": 50,
        "end": 119,
        "start_line": 1,
        "start_col": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119,
    "start_line": 1,
    "start_col": 0
  }
}
