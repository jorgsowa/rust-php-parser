===source===
<?php
enum Status {
    case Active;
    case Inactive;

    public function list(): array { return []; }
    public function match(): string { return ''; }
    public function switch(): void {}
}
===ast >=8.1===
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
                      "start": 29,
                      "end": 35
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 36
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 46,
                      "end": 54
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 41,
                "end": 55
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "list",
                    "span": {
                      "start": 77,
                      "end": 81
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                          "end": 90
                        }
                      }
                    },
                    "span": {
                      "start": 85,
                      "end": 90
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
                            "end": 102
                          }
                        }
                      },
                      "span": {
                        "start": 93,
                        "end": 103
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 61,
                "end": 105
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "match",
                    "span": {
                      "start": 126,
                      "end": 131
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                          "end": 141
                        }
                      }
                    },
                    "span": {
                      "start": 135,
                      "end": 141
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
                            "end": 153
                          }
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 154
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 110,
                "end": 156
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "switch",
                    "span": {
                      "start": 177,
                      "end": 183
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                          "end": 191
                        }
                      }
                    },
                    "span": {
                      "start": 187,
                      "end": 191
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 161,
                "end": 194
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 196
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 196
  }
}
