===source===
<?php

/**
 * Multi-method class
 * @package App\Models
 */
class Document {
    /**
     * Create document
     */
    public function create() {}

    /**
     * Update document
     */
    public function update() {}

    /**
     * Delete document
     */
    public function delete() {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Document",
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
                  "name": "create",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Create document\n     */",
                    "span": {
                      "start": 81,
                      "end": 115
                    }
                  }
                }
              },
              "span": {
                "start": 120,
                "end": 147
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "update",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Update document\n     */",
                    "span": {
                      "start": 153,
                      "end": 187
                    }
                  }
                }
              },
              "span": {
                "start": 192,
                "end": 219
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "delete",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Delete document\n     */",
                    "span": {
                      "start": 225,
                      "end": 259
                    }
                  }
                }
              },
              "span": {
                "start": 264,
                "end": 291
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Multi-method class\n * @package App\\Models\n */",
            "span": {
              "start": 7,
              "end": 59
            }
          }
        }
      },
      "span": {
        "start": 60,
        "end": 293
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 293
  }
}
