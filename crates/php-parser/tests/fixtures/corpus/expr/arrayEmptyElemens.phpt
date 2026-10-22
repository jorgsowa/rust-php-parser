===source===
<?php

[1, , 2];
array(1, , 2);
===errors===
Cannot use empty array elements in arrays
expected expression, found ','
===php_error===
PHP Fatal error:  Cannot use empty array elements in arrays in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 8,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 8,
                  "end": 9
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": "Omit",
                    "span": {
                      "start": 11,
                      "end": 12
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 13,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              }
            ]
          },
          "span": {
            "start": 7,
            "end": 15
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 23,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 24
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": "Error",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 27
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 29
                }
              }
            ]
          },
          "span": {
            "start": 17,
            "end": 30
          }
        }
      },
      "span": {
        "start": 17,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
