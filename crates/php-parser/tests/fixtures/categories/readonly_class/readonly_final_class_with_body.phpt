===config===
min_php=8.2
===source===
<?php readonly final class Point { public function __construct(public int $x, public int $y) {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Point",
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 70,
                              "end": 73,
                              "start_line": 1,
                              "start_col": 70
                            }
                          }
                        },
                        "span": {
                          "start": 70,
                          "end": 73,
                          "start_line": 1,
                          "start_col": 70
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 63,
                        "end": 76,
                        "start_line": 1,
                        "start_col": 63
                      }
                    },
                    {
                      "name": "y",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 85,
                              "end": 88,
                              "start_line": 1,
                              "start_col": 85
                            }
                          }
                        },
                        "span": {
                          "start": 85,
                          "end": 88,
                          "start_line": 1,
                          "start_col": 85
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 78,
                        "end": 91,
                        "start_line": 1,
                        "start_col": 78
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 96,
                "start_line": 1,
                "start_col": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 97,
        "start_line": 1,
        "start_col": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97,
    "start_line": 1,
    "start_col": 0
  }
}
