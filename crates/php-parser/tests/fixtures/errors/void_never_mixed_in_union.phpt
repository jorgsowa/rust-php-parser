===source===
<?php
function a(): int|void {}
function b(): int|never {}
function c(): int|mixed {}
===errors===
void cannot be used as part of a union type
never cannot be used as part of a union type
mixed cannot be used as part of a union type
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "a",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "void"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    },
    {
      "kind": {
        "Function": {
          "name": "b",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 46,
                        "end": 49
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 49
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "never"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 50,
                        "end": 55
                      }
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 55
                  }
                }
              ]
            },
            "span": {
              "start": 46,
              "end": 55
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 32,
        "end": 58
      }
    },
    {
      "kind": {
        "Function": {
          "name": "c",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 73,
                        "end": 76
                      }
                    }
                  },
                  "span": {
                    "start": 73,
                    "end": 76
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "mixed"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 77,
                        "end": 82
                      }
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 82
                  }
                }
              ]
            },
            "span": {
              "start": 73,
              "end": 82
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 59,
        "end": 85
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 85
  }
}
