===source===
<?php array(1, 2, 3); array('a' => 1, 'b' => 2);
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
                      "start": 12,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 13
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
                      "start": 15,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 15,
                  "end": 16
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 18,
                      "end": 19
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 28,
                    "end": 31
                  }
                },
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 36
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "b"
                  },
                  "span": {
                    "start": 38,
                    "end": 41
                  }
                },
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 46
                }
              }
            ]
          },
          "span": {
            "start": 22,
            "end": 47
          }
        }
      },
      "span": {
        "start": 22,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
