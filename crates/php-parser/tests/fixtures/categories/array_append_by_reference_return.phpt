===source===
<?php
function &f() { return $a[]; }
function &g() { yield $a[]; }
class C {
    public function &m() { return $this->d[]; }
    public $p { &get { return $this->d[]; } }
}
$h = fn&() => $a[];
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 6
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 6
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 29,
                          "end": 31
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 33
                  }
                }
              },
              "span": {
                "start": 22,
                "end": 34
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 47,
              "end": 48
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 59,
                                "end": 61
                              }
                            },
                            "index": null
                          }
                        },
                        "span": {
                          "start": 59,
                          "end": 63
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 63
                  }
                }
              },
              "span": {
                "start": 53,
                "end": 64
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 37,
        "end": 66
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 73,
              "end": 74
            }
          },
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
                    "name": "m",
                    "span": {
                      "start": 98,
                      "end": 99
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": true,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 111,
                                        "end": 116
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "d"
                                      },
                                      "span": {
                                        "start": 118,
                                        "end": 119
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 111,
                                  "end": 119
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 111,
                            "end": 121
                          }
                        }
                      },
                      "span": {
                        "start": 104,
                        "end": 122
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 81,
                "end": 124
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 136,
                      "end": 138
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 155,
                                              "end": 160
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "d"
                                            },
                                            "span": {
                                              "start": 162,
                                              "end": 163
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 155,
                                        "end": 163
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 155,
                                  "end": 165
                                }
                              }
                            },
                            "span": {
                              "start": 148,
                              "end": 166
                            }
                          }
                        ]
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 141,
                        "end": 168
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 129,
                "end": 170
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 67,
        "end": 172
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "h"
                },
                "span": {
                  "start": 173,
                  "end": 175
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": true,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 187,
                              "end": 189
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 187,
                        "end": 191
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 178,
                  "end": 191
                }
              }
            }
          },
          "span": {
            "start": 173,
            "end": 191
          }
        }
      },
      "span": {
        "start": 173,
        "end": 192
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 192
  }
}
