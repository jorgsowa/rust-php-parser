===source===
<?php
namespace N;
class B {}
class A extends B {
    function a(): A|self {}
    function b(): self|\N\A {}
    function c(): (A&X)|self {}
    function d(): B|parent {}
}
===errors >=8.5===
Duplicate type 'self' in union type
Duplicate type '\N\A' in union type
Type N\A&N\X is redundant as it is more restrictive than type N\A
Duplicate type 'parent' in union type
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 7
===php_error >=8.5===
PHP Fatal error:  Duplicate type N\A is redundant in Standard input code on line 5
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 25,
              "end": 26
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 29
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 36,
              "end": 37
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 46,
              "end": 47
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 63,
                      "end": 64
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 68,
                                "end": 69
                              }
                            }
                          },
                          "span": {
                            "start": 68,
                            "end": 69
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 70,
                                "end": 74
                              }
                            }
                          },
                          "span": {
                            "start": 70,
                            "end": 74
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 68,
                      "end": 74
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 77
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 91,
                      "end": 92
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 96,
                                "end": 100
                              }
                            }
                          },
                          "span": {
                            "start": 96,
                            "end": 100
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "N",
                                "A"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 101,
                                "end": 105
                              }
                            }
                          },
                          "span": {
                            "start": 101,
                            "end": 105
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 96,
                      "end": 105
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 82,
                "end": 108
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 122,
                      "end": 123
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 128,
                                      "end": 129
                                    }
                                  }
                                },
                                "span": {
                                  "start": 128,
                                  "end": 129
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "X"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 130,
                                      "end": 131
                                    }
                                  }
                                },
                                "span": {
                                  "start": 130,
                                  "end": 131
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 127,
                            "end": 132
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 133,
                                "end": 137
                              }
                            }
                          },
                          "span": {
                            "start": 133,
                            "end": 137
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 127,
                      "end": 137
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 113,
                "end": 140
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 154,
                      "end": 155
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 159,
                                "end": 160
                              }
                            }
                          },
                          "span": {
                            "start": 159,
                            "end": 160
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 161,
                                "end": 167
                              }
                            }
                          },
                          "span": {
                            "start": 161,
                            "end": 167
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 159,
                      "end": 167
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 145,
                "end": 170
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 30,
        "end": 172
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 172
  }
}
