===config===
min_php=8.1
===source===
<?php
enum Status {
    case Active;
    case Inactive;

    public function list(): array { return []; }
    public function match(): string { return ''; }
    public function switch(): void {}
}
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
                "start": 24,
                "end": 41,
                "start_line": 3,
                "start_col": 4
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
                "start": 41,
                "end": 61,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "list",
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
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 85,
                          "end": 90,
                          "start_line": 6,
                          "start_col": 28
                        }
                      }
                    },
                    "span": {
                      "start": 85,
                      "end": 90,
                      "start_line": 6,
                      "start_col": 28
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 100,
                            "end": 102,
                            "start_line": 6,
                            "start_col": 43
                          }
                        }
                      },
                      "span": {
                        "start": 93,
                        "end": 104,
                        "start_line": 6,
                        "start_col": 36
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 61,
                "end": 110,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "match",
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
                          "start": 135,
                          "end": 141,
                          "start_line": 7,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 135,
                      "end": 141,
                      "start_line": 7,
                      "start_col": 29
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 151,
                            "end": 153,
                            "start_line": 7,
                            "start_col": 45
                          }
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 155,
                        "start_line": 7,
                        "start_col": 38
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 110,
                "end": 161,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "switch",
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
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 187,
                          "end": 191,
                          "start_line": 8,
                          "start_col": 30
                        }
                      }
                    },
                    "span": {
                      "start": 187,
                      "end": 191,
                      "start_line": 8,
                      "start_col": 30
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 161,
                "end": 195,
                "start_line": 8,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 196,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 196,
    "start_line": 1,
    "start_col": 0
  }
}
