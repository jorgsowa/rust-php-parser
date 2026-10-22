===source===
<?php
class A {}
$a = new class {
    function f(self&B $x) {}
    function g(): A|self {}
};
$b = new class extends A {
    function f(parent&B $x) {}
    function g(): A|parent {}
};
===errors >=8.5===
Type self cannot be part of an intersection type
Type parent cannot be part of an intersection type
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "B", expecting variable in Standard input code on line 4
===php_error >=8.1===
PHP Fatal error:  Type self cannot be part of an intersection type in Standard input code on line 4
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
        "start": 6,
        "end": 16
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
                  "start": 17,
                  "end": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "f",
                                    "span": {
                                      "start": 47,
                                      "end": 48
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [
                                    {
                                      "name": {
                                        "name": "x",
                                        "span": {
                                          "start": 56,
                                          "end": 58
                                        }
                                      },
                                      "type_hint": {
                                        "kind": {
                                          "Intersection": [
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "self"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 49,
                                                    "end": 53
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 49,
                                                "end": 53
                                              }
                                            },
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "B"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 54,
                                                    "end": 55
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 54,
                                                "end": 55
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 49,
                                          "end": 55
                                        }
                                      },
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 49,
                                        "end": 58
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 38,
                                "end": 62
                              }
                            },
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "g",
                                    "span": {
                                      "start": 76,
                                      "end": 77
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
                                                "start": 81,
                                                "end": 82
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 81,
                                            "end": 82
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
                                                "start": 83,
                                                "end": 87
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 83,
                                            "end": 87
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 81,
                                      "end": 87
                                    }
                                  },
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 67,
                                "end": 90
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 92
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 92
          }
        }
      },
      "span": {
        "start": 17,
        "end": 93
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 94,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 117,
                              "end": 118
                            }
                          },
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "f",
                                    "span": {
                                      "start": 134,
                                      "end": 135
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [
                                    {
                                      "name": {
                                        "name": "x",
                                        "span": {
                                          "start": 145,
                                          "end": 147
                                        }
                                      },
                                      "type_hint": {
                                        "kind": {
                                          "Intersection": [
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "parent"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 136,
                                                    "end": 142
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 136,
                                                "end": 142
                                              }
                                            },
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "B"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 143,
                                                    "end": 144
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 143,
                                                "end": 144
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 136,
                                          "end": 144
                                        }
                                      },
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 136,
                                        "end": 147
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 125,
                                "end": 151
                              }
                            },
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "g",
                                    "span": {
                                      "start": 165,
                                      "end": 166
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
                                                "start": 170,
                                                "end": 171
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 170,
                                            "end": 171
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
                                                "start": 172,
                                                "end": 178
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 172,
                                            "end": 178
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 170,
                                      "end": 178
                                    }
                                  },
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 156,
                                "end": 181
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 99,
                        "end": 183
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 99,
                  "end": 183
                }
              }
            }
          },
          "span": {
            "start": 94,
            "end": 183
          }
        }
      },
      "span": {
        "start": 94,
        "end": 184
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 184
  }
}
