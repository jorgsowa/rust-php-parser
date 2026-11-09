===source===
<?php
$a = [...1];
$a = [...[1], ...[...'a']];
$a = [1, [...null]];
$a = array(...1.5);
$a = [...PHP_INT_MAX];
const C = [...true];
function f($a = [...false]) {}
===errors===
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, string given
Only arrays and Traversables can be unpacked, null given
Only arrays and Traversables can be unpacked, float given
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, true given
Only arrays and Traversables can be unpacked, false given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, int given in Standard input code on line 2
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 15,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 19,
                  "end": 21
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
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
                                      "start": 29,
                                      "end": 30
                                    }
                                  }
                                },
                                "span": {
                                  "start": 29,
                                  "end": 30
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 28,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 31
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Spread": {
                                    "kind": {
                                      "String": "a"
                                    },
                                    "span": {
                                      "start": 40,
                                      "end": 43
                                    }
                                  }
                                },
                                "span": {
                                  "start": 37,
                                  "end": 43
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 36,
                            "end": 44
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 44
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 45
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 45
          }
        }
      },
      "span": {
        "start": 19,
        "end": 46
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 47,
                  "end": 49
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 53,
                            "end": 54
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Spread": {
                                    "kind": "Null",
                                    "span": {
                                      "start": 60,
                                      "end": 64
                                    }
                                  }
                                },
                                "span": {
                                  "start": 57,
                                  "end": 64
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 56,
                            "end": 65
                          }
                        }
                      },
                      "span": {
                        "start": 56,
                        "end": 65
                      }
                    }
                  ]
                },
                "span": {
                  "start": 52,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 66
          }
        }
      },
      "span": {
        "start": 47,
        "end": 67
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 68,
                  "end": 70
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Float": 1.5
                          },
                          "span": {
                            "start": 82,
                            "end": 85
                          }
                        }
                      },
                      "span": {
                        "start": 79,
                        "end": 85
                      }
                    }
                  ]
                },
                "span": {
                  "start": 73,
                  "end": 86
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 86
          }
        }
      },
      "span": {
        "start": 68,
        "end": 87
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 88,
                  "end": 90
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "PHP_INT_MAX"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 97,
                                "end": 108
                              }
                            }
                          },
                          "span": {
                            "start": 97,
                            "end": 108
                          }
                        }
                      },
                      "span": {
                        "start": 94,
                        "end": 108
                      }
                    }
                  ]
                },
                "span": {
                  "start": 93,
                  "end": 109
                }
              }
            }
          },
          "span": {
            "start": 88,
            "end": 109
          }
        }
      },
      "span": {
        "start": 88,
        "end": 110
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 117,
                "end": 118
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "Spread": {
                        "kind": {
                          "Bool": true
                        },
                        "span": {
                          "start": 125,
                          "end": 129
                        }
                      }
                    },
                    "span": {
                      "start": 122,
                      "end": 129
                    }
                  }
                ]
              },
              "span": {
                "start": 121,
                "end": 130
              }
            },
            "attributes": [],
            "span": {
              "start": 117,
              "end": 130
            }
          }
        ]
      },
      "span": {
        "start": 111,
        "end": 131
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 141,
              "end": 142
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 143,
                  "end": 145
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Bool": false
                          },
                          "span": {
                            "start": 152,
                            "end": 157
                          }
                        }
                      },
                      "span": {
                        "start": 149,
                        "end": 157
                      }
                    }
                  ]
                },
                "span": {
                  "start": 148,
                  "end": 158
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 143,
                "end": 158
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 132,
        "end": 162
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 162
  }
}
