===source===
<?php
/** @var User $current */
if ($current = $users->find($id)) {
    $current->activate();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Assign": {
                "target": {
                  "kind": {
                    "Variable": "current"
                  },
                  "span": {
                    "start": 36,
                    "end": 44
                  }
                },
                "op": "Assign",
                "value": {
                  "kind": {
                    "MethodCall": {
                      "object": {
                        "kind": {
                          "Variable": "users"
                        },
                        "span": {
                          "start": 47,
                          "end": 53
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "find"
                        },
                        "span": {
                          "start": 55,
                          "end": 59
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Variable": "id"
                            },
                            "span": {
                              "start": 60,
                              "end": 63
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 60,
                            "end": 63
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 64
                  }
                }
              }
            },
            "span": {
              "start": 36,
              "end": 64
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "current"
                            },
                            "span": {
                              "start": 72,
                              "end": 80
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "activate"
                            },
                            "span": {
                              "start": 82,
                              "end": 90
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 92
                      }
                    }
                  },
                  "span": {
                    "start": 72,
                    "end": 93
                  }
                }
              ]
            },
            "span": {
              "start": 66,
              "end": 95
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 32,
        "end": 95
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** @var User $current */",
        "span": {
          "start": 6,
          "end": 31
        }
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 95
  }
}
