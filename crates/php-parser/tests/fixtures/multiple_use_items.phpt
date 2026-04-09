===source===
<?php use App\Models\User, App\Models\Post, App\Models\Comment;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "Models",
                  "User"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 25,
                "start_line": 1,
                "start_col": 10
              }
            },
            {
              "name": {
                "parts": [
                  "App",
                  "Models",
                  "Post"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 27,
                  "end": 42,
                  "start_line": 1,
                  "start_col": 27
                }
              },
              "alias": null,
              "span": {
                "start": 27,
                "end": 42,
                "start_line": 1,
                "start_col": 27
              }
            },
            {
              "name": {
                "parts": [
                  "App",
                  "Models",
                  "Comment"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 44,
                  "end": 62,
                  "start_line": 1,
                  "start_col": 44
                }
              },
              "alias": null,
              "span": {
                "start": 44,
                "end": 62,
                "start_line": 1,
                "start_col": 44
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 63,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
