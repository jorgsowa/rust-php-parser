===source===
<?php
if ($a) { echo 1; }
while ($b) { echo 2; }
for ($i = 0; $i < 10; $i++) { echo 3; }
foreach ($arr as $v) { echo 4; }
switch ($x) { case 1: break; }
try { echo 5; } catch (Exception $e) { echo 6; } finally { echo 7; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 10,
              "end": 12
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 16,
                    "end": 23
                  }
                }
              ]
            },
            "span": {
              "start": 14,
              "end": 25
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 33,
              "end": 35
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 44,
                          "end": 45
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 39,
                    "end": 46
                  }
                }
              ]
            },
            "span": {
              "start": 37,
              "end": 48
            }
          }
        }
      },
      "span": {
        "start": 26,
        "end": 48
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 54,
                      "end": 56
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 59,
                      "end": 60
                    }
                  }
                }
              },
              "span": {
                "start": 54,
                "end": 60
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 62,
                      "end": 64
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 67,
                      "end": 69
                    }
                  }
                }
              },
              "span": {
                "start": 62,
                "end": 69
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 71,
                      "end": 73
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 71,
                "end": 75
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 84,
                          "end": 85
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 79,
                    "end": 86
                  }
                }
              ]
            },
            "span": {
              "start": 77,
              "end": 88
            }
          }
        }
      },
      "span": {
        "start": 49,
        "end": 88
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "arr"
            },
            "span": {
              "start": 98,
              "end": 102
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 106,
              "end": 108
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 4
                        },
                        "span": {
                          "start": 117,
                          "end": 118
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 112,
                    "end": 119
                  }
                }
              ]
            },
            "span": {
              "start": 110,
              "end": 121
            }
          }
        }
      },
      "span": {
        "start": 89,
        "end": 121
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 130,
              "end": 132
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 141,
                  "end": 142
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 144,
                    "end": 150
                  }
                }
              ],
              "span": {
                "start": 136,
                "end": 150
              }
            }
          ]
        }
      },
      "span": {
        "start": 122,
        "end": 152
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "Int": 5
                    },
                    "span": {
                      "start": 164,
                      "end": 165
                    }
                  }
                ]
              },
              "span": {
                "start": 159,
                "end": 166
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 176,
                    "end": 185
                  }
                }
              ],
              "var": "e",
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 6
                        },
                        "span": {
                          "start": 197,
                          "end": 198
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 192,
                    "end": 199
                  }
                }
              ],
              "span": {
                "start": 175,
                "end": 201
              }
            }
          ],
          "finally": [
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "Int": 7
                    },
                    "span": {
                      "start": 217,
                      "end": 218
                    }
                  }
                ]
              },
              "span": {
                "start": 212,
                "end": 219
              }
            }
          ]
        }
      },
      "span": {
        "start": 153,
        "end": 221
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 221
  }
}
